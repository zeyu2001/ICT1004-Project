<form action="process_skills.php" method="post" id="skills-form">
    <div class="form-row align-items-center">
        <div class="col-md-12 mb-3">
            <label for="skill1-name">Skill 1 Name</label> 
            <input class="form-control" type="text" id="skill1-name" required
                   maxlength="45" 
                   placeholder ="e.g. PHP"
                   name="skill1-name" value=""
                   pattern="^[a-zA-Z\s\.\-,!?]*$">
        </div>                                    
    </div>

    <div class="form-row align-items-center">
        <div class="col-md-3 mb-3">
            <label for="skill1-value">Skill 1 Value</label>
            <input class="form-control skill-value" required 
                   name="skill1-value" id="skill1-value" 
                   type="number" min="1" max="100" placeholder="e.g. 50">
        </div>
        <div class="col-md-9 mb-3">
            <label for="skill1-slider" class="label-hidden">Skill 1 Slider</label> 
            <input name="skill1-slider" id="skill1-slider" 
                   type="range" min="1" max="100" value="50" 
                   class=" form-control slider skill-slider">
        </div>
    </div>

    <div class="form-row align-items-center">
        <div class="col-md-12 mb-3">
            <label for="skill2-name">Skill 2 Name</label> 
            <input class="form-control" type="text" id="skill2-name" required
                   maxlength="45" 
                   placeholder ="e.g. MySQL"
                   name="skill2-name" value=""
                   pattern="^[a-zA-Z\s\.\-,!?]*$">
        </div>
    </div>

    <div class="form-row align-items-center">
        <div class="col-md-3 mb-3">
            <label for="skill2-value">Skill 2 Value</label>
            <input class="form-control skill-value" required 
                   name="skill2-value" id="skill2-value" 
                   type="number" min="1" max="100" placeholder="e.g. 50">
        </div>
        <div class="col-md-9 mb-3">
            <label for="skill2-slider" class="label-hidden">Skill 2 Slider</label> 
            <input name="skill2-slider" id="skill2-slider" 
                   type="range" min="1" max="100" value="50" 
                   class=" form-control slider skill-slider">
        </div>
    </div>

    <div class="form-row align-items-center">
        <div class="col-md-12 mb-3">
            <label for="skill3-name">Skill 3 Name</label> 
            <input class="form-control" type="text" id="skill3-name" required
                   maxlength="45" 
                   placeholder ="e.g. JavaScript"
                   name="skill3-name" value=""
                   pattern="^[a-zA-Z\s\.\-,!?]*$">
        </div>
    </div>

    <div class="form-row align-items-center">
        <div class="col-md-3 mb-3">
            <label for="skill3-value">Skill 3 Value</label>
            <input class="form-control skill-value" required 
                   name="skill3-value" id="skill3-value" 
                   type="number" min="1" max="100" placeholder="e.g. 50">
        </div>
        <div class="col-md-9 mb-3">
            <label for="skill3-slider" class="label-hidden">Skill 3 Slider</label> 
            <input name="skill3-slider" id="skill3-slider" 
                   type="range" min="1" max="100" value="50" 
                   class=" form-control slider skill-slider">
        </div>
    </div>

    <div class="form-row">
        <button class="btn btn-primary" type="submit">Update</button> 
    </div>
</form>