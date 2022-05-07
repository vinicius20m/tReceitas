

var iC = $('.ingredient-stage').length

var ingredients = []
for (let key = 1; key <= iC; key++) {

      let stepC =  $('.ingredient-'+key+'-step').length

      ingredients[key] = stepC;
}

var pC = $('.preparation-stage').length

var preparations = []
for (let key = 1; key <= pC; key++) {

      let stepC =  $('.preparation-'+key+'-step').length

      preparations[key] = stepC;
}

function AddIngredient()
{

      iC ++
      let ingredientsDiv = $('#ingredients')

      ingredientsDiv.append(`

            <div class="ingredient-stage" id="ingredient-stage-${iC}" style="
                  border: 2px solid;
                  border-radius: 15px;
                  border-color: #ffd66d;
                  background: #f6fdff;
                  margin-bottom: 40px;
                  box-shadow: inset 5px 11px 9px 3px rgb(197 202 205 / 84%);
            ">
                  <div style="
                        padding: 0px;
                        border-bottom: 4px solid;
                        border-color: #ffd66d;
                        display:grid;
                        place-items:center;
                        overflow:hidden
                  ">
                        <input name="ingredientTitle[${iC}]" type="text"
                              class="text-center form-control"
                              style="
                                    border-top-left-radius: 13px;
                                    border-top-right-radius: 13px;
                                    font-weight: bold;
                                    font-size: 30px;
                                    background: #fff9aba1
                              "
                        >
                        <a href="#ingredient-stage-${iC}" class="close" data-dismiss="alert" aria-label="close"
                              id="hide" style="position: absolute; left: 94%; font-size: 35px;"
                        >&times;</a>
                  </div>

                  <div class="gap-40"></div>

                  <ul id="ingredient-${iC}-steps">
                  </ul>

                  <button
                        style="border-radius: 10px;
                              margin-left: 10px;
                              margin-bottom: 10px;
                        "
                        class="btn btn-outline-warning"
                        onclick="AddIngredientStep(${iC})"
                        type="button"
                  >+</button>

                  <div class="gap-20" style="border-top: 2px solid; border-color: #ffd66d;"></div>
            </div>
      `)
}

function AddIngredientStep(ingCount)
{

      let stepC =  $('.ingredient-'+ingCount+'-step').length
      if(stepC == 0)
            ingredients[ingCount] = 0

      let step = ++ ingredients[ingCount]
      let stepsDiv = $('#ingredient-'+ingCount+'-steps')

      stepsDiv.append(`

            <li style="margin-bottom: 10px" class="ingredient-${ingCount}-step" id="ingredient-${ingCount}-step-${step}">
                  <div class="row">

                        <input name="ingredient-step[${ingCount}][]"
                              type="text"
                              class="form-control"
                              style="max-width: 600px; margin-left: 15px"
                        >
                        <a href="#ingredient-${ingCount}-step-${step}" class="close" data-dismiss="alert" aria-label="close"
                              id="hide" style="margin-left: 40px; margin-top: 10px"
                        >&times;</a>
                  </div>
            </li>
      `)
}

// PREPARATION FUNCTIONS

function AddPreparation()
{

      pC ++
      let preparationsDiv = $('#preparations')

      preparationsDiv.append(`

            <div class="preparation-stage" id="preparation-stage-${pC}" style="
                  border: 2px solid;
                  border-radius: 15px;
                  border-color: #ffd66d;
                  background: #f6fdff;
                  margin-bottom: 40px;
                  box-shadow: inset 5px 11px 9px 3px rgb(197 202 205 / 84%);
            ">
                  <div style="
                        padding: 0px;
                        border-bottom: 4px solid;
                        border-color: #ffd66d;
                        display:grid;
                        place-items:center;
                        overflow:hidden
                  ">
                        <input name="preparationTitle[${pC}]" type="text"
                              class="text-center form-control"
                              style="
                                    border-top-left-radius: 13px;
                                    border-top-right-radius: 13px;
                                    font-weight: bold;
                                    font-size: 30px;
                                    background: #fff9aba1
                              "
                        >
                        <a href="#preparation-stage-${pC}" class="close" data-dismiss="alert" aria-label="close"
                              id="hide" style="position: absolute; left: 94%; font-size: 35px;"
                        >&times;</a>
                  </div>

                  <div class="gap-40"></div>

                  <ol id="preparation-${pC}-steps">
                  </ol>

                  <button
                        style="border-radius: 10px;
                              margin-left: 10px;
                              margin-bottom: 10px;
                        "
                        class="btn btn-outline-warning"
                        onclick="AddPreparationStep(${pC})"
                        type="button"
                  >+</button>

                  <div class="gap-20" style="border-top: 2px solid; border-color: #ffd66d;"></div>
            </div>
      `)
}

function AddPreparationStep(prepCount)
{

      let stepC =  $('.preparation-'+prepCount+'-step').length
      if(stepC == 0)
            preparations[prepCount] = 0

      let step = ++ preparations[prepCount]
      let stepsDiv = $('#preparation-'+prepCount+'-steps')

      stepsDiv.append(`

            <li style="margin-bottom: 10px" class="preparation-${prepCount}-step" id="preparation-${prepCount}-step-${step}">
                  <div class="row">

                        <input name="preparation-step[${prepCount}][]"
                              type="text"
                              class="form-control"
                              style="max-width: 600px; margin-left: 15px"
                        >
                        <a href="#preparation-${prepCount}-step-${step}" class="close" data-dismiss="alert" aria-label="close"
                              id="hide" style="margin-left: 40px; margin-top: 10px"
                        >&times;</a>
                  </div>
            </li>
      `)
}
