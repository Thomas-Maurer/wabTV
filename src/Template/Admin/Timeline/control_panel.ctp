<div ng-controller="adminTimelineController">
  <div ng-cloak>
    <md-content>
      <md-tabs md-dynamic-height md-border-bottom>
        <md-tab label={{key}} ng-repeat="(key, day) in prog">
          <md-content class="md-padding" ng-repeat="(keyEvent, event) in calendar[key]">
            <h1 class="md-display-2">{{event.horaire}}</h1>
            <br>
            <form>
              Titre : <textarea type="textarea" ng-model="prog[key][keyEvent].title" value=prog[key][keyEvent].title></textarea>
              Streamer : <input type="text" ng-model="prog[key][keyEvent].streamer" value=prog[key][keyEvent].streamer>
                <input type="submit" ng-click="update()" value="Save" />
            </form>
          </md-content>
        </md-tab>
      </md-tabs>
    </md-content>
  </div>

</div>