<?php $events = $competition->getEventsRounds(); ?>
<?php $params = $competition->getLastActiveEventRound($events); ?>
<?php echo CHtml::tag('div', array(
  'id'=>'live-container',
  'data-competition-id'=>$competition->id,
  'data-events'=>json_encode($events),
  'data-params'=>json_encode($params),
  'data-user'=>json_encode(array(
    'isGuest'=>Yii::app()->user->isGuest,
    'isOrganizer'=>!Yii::app()->user->isGuest && $this->user->isOrganizer() && isset($competition->organizers[$this->user->id]),
    'isDelegate'=>!Yii::app()->user->isGuest && $this->user->isDelegate() && isset($competition->delegates[$this->user->id]),
    'isAdmin'=>Yii::app()->user->checkRole(User::ROLE_ADMINISTRATOR),
    'name'=>Yii::app()->user->isGuest ? '' : $this->user->getCompetitionName(),
  )),
  'v-cloak'=>true,
), ''); ?>

<template id="live-container-template">
  <div class="col-lg-12">
    <chat></chat>
    <result></result>
  </div>
</template>

<template id="chat-template">
  <div class="message-container">
    <ul class="unstyled">
      <li v-for="message in messages">
        <message :message="message"></message>
      </li>
    </ul>
  </div>
  <div class="input-panel">
    <input v-model="message" @keyup.enter="send" :disabled="$store.state.user.isGuest" placeholder="<?php echo Yii::app()->user->isGuest ? Yii::t('common', 'Please login.') : ''; ?>" />
  </div>
</template>

<template id="message-template">
  <div class="chat-message" :class="{'self-message': message.isSelf}">
    <div class="message-meta">
      {{message.user.name}} {{message.time | formatTime}}
    </div>
    <div class="message-body">
      {{message.content}}
    </div>
  </div>
</template>

<template id="result-template">
  <div class="row">
    <div class="col-md-3" v-if="hasPermission">
      <input-panel></input-panel>
    </div>
    <div class="col-md-{{hasPermission ? 9 : 12}}">
      <div class="clearfix">
        <h4 class="pull-left">{{eventName}} - {{roundName}}</h4>
        <div class="pull-right">
          <select @change="changeEventRound" v-model="eventRound">
            <optgroup v-for="event in events" :label="event.name">
              <option v-for="round in event.rounds" :value="{event: event.id, round: round.id}">
                {{event.name}} - {{round.name}}{{round.status != 0 ? ' - ' + round.statusText : ''}}
              </option>
            </optgroup>
          </select>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-condensed table-hover table-boxed">
          <thead>
            <?php $columns = array(
              array(
                'name'=>Yii::t('Results', 'Place'),
                'value'=>'$data->pos',
                'htmlOptions'=>array('class'=>'place'),
              ),
              array(
                'name'=>Yii::t('Results', 'Person'),
                'value'=>'Persons::getLinkByNameNId($data->personName, $data->personId)',
              ),
              array(
                'name'=>Yii::t('common', 'Best'),
                'value'=>'$data->getTime("best")',
                'htmlOptions'=>array('class'=>'result'),
              ),
              array(
                'name'=>'',
                'value'=>'$data->regionalSingleRecord',
                'htmlOptions'=>array('class'=>'record'),
              ),
              array(
                'name'=>Yii::t('common', 'Average'),
                'value'=>'$data->getTime("average")',
                'htmlOptions'=>array('class'=>'result'),
              ),
              array(
                'name'=>'',
                'value'=>'$data->regionalAverageRecord',
                'htmlOptions'=>array('class'=>'record'),
              ),
              array(
                'name'=>Yii::t('common', 'Region'),
                'value'=>'Region::getIconName($data->person->country->name, $data->person->country->iso2)',
                'htmlOptions'=>array('class'=>'region'),
              ),
              array(
                'name'=>Yii::t('common', 'Detail'),
                'value'=>'$data->detail',
              ),
            ); ?>
            <?php foreach ($columns as $column): ?>
            <?php echo CHtml::tag('th', isset($column['htmlOptions']) ? $column['htmlOptions'] : array(), $column['name']); ?>
            <?php endforeach; ?>
          </thead>
          <tbody>
            <tr v-if="loading" class="loading">
              <td colspan="8">
                Loading...
              </td>
            </tr>
            <tr v-for="result in results" :class="{danger: result.isNew}" @click="click(result)">
              <td>{{result.pos}}</td>
              <td>{{{result.user.name}}}</td>
              <td class="result">{{result.best | decodeResult result.event}}</td>
              <td class="record">{{result.regional_single_record}}</td>
              <td class="result">{{result.average | decodeResult result.event}}</td>
              <td class="record">{{result.regional_average_record}}</td>
              <td>{{{result.user.region}}}</td>
              <td>{{result.detail}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<template id="input-panel-template">
  <div data-spy="affix" data-offset-top="550" style="top:20px">
    
  </div>
</template>