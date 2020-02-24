<table class="table">
    <tbody>
    <tr>
      <th style="width:300px">Organization</th>
      <th>Avg. Budget</th>
      <th class="text-center" style="width: 40px">%</th>
    </tr>
    <?php $c = true; foreach($stats['avgUnitsPerOrg'] as $org):?>
    <tr>
      <td>{{ $org['orgName'] }}</td>
      <td>
        <div class="progress hidden-xs">
          <div class="progress-bar progress-bar-primary" style="width: {{ round($org['pctUnits']*100) }}%"></div>&nbsp; {{ round($org['avgUnits']) }}
        </div>
        <span class="visible-xs">{{ round($org['avgUnits']) }}</span>
      </td>
      <td>{{ round($org['pctUnits']*100) }}%</td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>