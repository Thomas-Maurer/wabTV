<div ng-controller="progController">
    <table class="responstable">
        <tr class="days">
            <th scope="col" title="Monday"></th>
            <th scope="col" title="Monday">Lundi</th>
            <th scope="col" title="Monday">Mardi</th>
            <th scope="col" title="Monday">Mercredi</th>
            <th scope="col" title="Monday">Jeudi</th>
            <th scope="col" title="Monday">Vendredi</th>
            <th scope="col" title="Monday">Samedi</th>
            <th scope="col" title="Monday">Dimanche</th>
        </tr>
        <tr>
            <td>
                17h00
                <br>
                -
                <br>
                20h00
            </td>
            <td>
                <span ng-if="calendar['lundi'][0].title !== ''">
                    {{calendar['lundi'][0].title}} Avec {{calendar['lundi'][0].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['mardi'][0].title !== ''">
                    {{calendar['mardi'][0].title}} Avec {{calendar['mardi'][0].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['mercredi'][0].title !== ''">
                    {{calendar['mercredi'][0].title}} Avec {{calendar['mercredi'][0].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['jeudi'][0].title !== ''">
                    {{calendar['jeudi'][0].title}} Avec {{calendar['jeudi'][0].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['vendredi'][0].title !== ''">
                    {{calendar['vendredi'][0].title}} Avec {{calendar['vendredi'][0].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['samedi'][0].title !== ''">
                    {{calendar['samedi'][0].title}} Avec {{calendar['samedi'][0].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['dimanche'][0].title !== ''">
                    {{calendar['dimanche'][0].title}} Avec {{calendar['dimanche'][0].streamer}}
                </span>
            </td>

        </tr>
        <tr>
            <td>
                20h00
                <br>
                -
                <br>
                00h00
            </td>
            <td>
                <span ng-if="calendar['lundi'][1].title !== ''">
                    {{calendar['lundi'][1].title}} Avec {{calendar['lundi'][1].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['mardi'][1].title !== ''">
                    {{calendar['mardi'][1].title}} Avec {{calendar['mardi'][1].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['mercredi'][1].title !== ''">
                    {{calendar['mercredi'][1].title}} Avec {{calendar['mercredi'][1].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['jeudi'][1].title !== ''">
                    {{calendar['jeudi'][1].title}} Avec {{calendar['jeudi'][1].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['vendredi'][1].title !== ''">
                    {{calendar['vendredi'][1].title}} Avec {{calendar['vendredi'][1].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['samedi'][1].title !== ''">
                    {{calendar['samedi'][1].title}} Avec {{calendar['samedi'][1].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['dimanche'][1].title !== ''">
                    {{calendar['dimanche'][1].title}} Avec {{calendar['dimanche'][1].streamer}}
                </span>
            </td>
        <tr>
            <td>
                00h00
                <br>
                -
                <br>
                02h00
            </td>
            <td>
                <span ng-if="calendar['lundi'][2].title !== ''">
                    {{calendar['lundi'][2].title}} Avec {{calendar['lundi'][2].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['mardi'][2].title !== ''">
                    {{calendar['mardi'][2].title}} Avec {{calendar['mardi'][2].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['mercredi'][2].title !== ''">
                    {{calendar['mercredi'][2].title}} Avec {{calendar['mercredi'][2].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['jeudi'][2].title !== ''">
                    {{calendar['jeudi'][2].title}} Avec {{calendar['jeudi'][2].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['vendredi'][2].title !== ''">
                    {{calendar['vendredi'][2].title}} Avec {{calendar['vendredi'][2].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['samedi'][2].title !== ''">
                    {{calendar['samedi'][2].title}} Avec {{calendar['samedi'][2].streamer}}
                </span>
            </td>
            <td>
                <span ng-if="calendar['dimanche'][2].title !== ''">
                    {{calendar['dimanche'][2].title}} Avec {{calendar['dimanche'][2].streamer}}
                </span>
            </td>
        </tr>
    </table>
</div>