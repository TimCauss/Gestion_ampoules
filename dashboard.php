<main>
        <table>

            <thead>
                <th>Date</th>
                <th>Floor</th>
                <th>Position</th>
                <th>Price</th>
                <th>Actions</th>
            </thead>

            <tbody>
                <form class="edit-form" method="POST">
                    <?php
                    foreach ($result as $row) {
                    ?>
                        <tr>
                            <td class="td-hover">
                                <input class="edit_input date_<?= $row['id'] ?>" type="date" name="edit_date" value='<?= $row["create_date"] ?>'>
                            </td>
                            <td class="td-hover td-small">
                                <input class="edit_input stage_<?= $row['id'] ?>" name="edit_stage" type="number" min="0" max="8" value="<?= $row['stage'] ?>">
                            </td>
                            <td class="td-hover td-position">
                                <select class="edit_input position_<?= $row['id'] ?>" name="edit_position">
                                    <option value="<?= $row["position"] ?>"><?= $row["position"] ?></option>
                                    <option value="North">North</option>
                                    <option value="South">South</option>
                                    <option value="East">East</option>
                                    <option value="West">West</option>
                                </select>
                            </td>
                            <td class="td-hover td-ligne">
                                <span class="dollar">$</span><input class="edit_input price_<?= $row['id'] ?> pricetag" type="text" name="edit_price" value='<?= $row["price"] ?>'>
                            </td>
                            <td class="td-hover">

                                <svg class="modal-trigger2 trash" id="trash" data-id="<?= $row["id"] ?>" width="13" height="13" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.25 17.25 6.75 6.75"></path>
                                    <path d="m17.25 6.75-10.5 10.5"></path>
                                </svg>

                                <svg data-id="<?= $row["id"] ?>" id="check" class="modal-trigger3" width="14" height="14" stroke-width="0.541667" stroke="currentColor" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.6691 3.75L4.9816 10.25L2.5441 7.8125" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </form>
            </tbody>
        </table>
    </main>