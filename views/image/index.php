<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card rounded-3">
                    <div class="card-body p-4">

                        <h4 class="text-center my-3 pb-3">To Do App</h4>

                        <!-- <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2"
                            method="POST" enctype="multipart/form-data" action="/image/upload">
                            <div class="col-12">
                                <div class="form-outline">
                                    <input type="hidden" name="_csrf"
                                        value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                    <input class="form-control" type="file" name="imageFiles">
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form> -->
                        <?php

                        use yii\widgets\ActiveForm;
                        ?>

                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                        <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

                        <button>Submit</button>

                        <?php ActiveForm::end() ?>
                        <?php $request = Yii::$app->request; ?>
                        <form action="/">
                            <select class="form-select" aria-label="Default select example" name="order"
                                onchange="this.form.submit()">>
                                <option value="desc" selected>DESC</option>
                                <option value="asc" <?php if ($request->get('order') == 'asc') : ?>selected
                                    <?php endif; ?>>ASC
                                </option>
                            </select>
                        </form>
                        <table class="table mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Todo item</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($datas)) : ?>
                                <?php foreach ($datas as $data) : ?>
                                <tr>
                                    <th scope="row"><?= $data['id'] ?></th>
                                    <td><?= $data['name']; ?></td>
                                    <td><img src="/uploads/<?= $data['name'] ?>" alt="" width="100px"></td>
                                    <td>
                                        <form action="/image/destroy" method="GET">
                                            <input type="text" name="id" value="<?= $data['id'] ?>" hidden>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>