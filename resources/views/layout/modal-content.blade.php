<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ng-click="cancelar()">&times;</button>

    <h3 class="modal-title">@{{title}}</h3>
</div>
<div class="modal-body" ng-bind-html="content" style="overflow: scroll"></div>
