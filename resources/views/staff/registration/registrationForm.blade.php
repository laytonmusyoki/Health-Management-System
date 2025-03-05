@extends('staff.app')
@section('title','Registration')
@section('content')

<form action="{{route('registrationFormPost')}}" method="post">
    @php
    use App\Models\County;
    use App\Models\SubCounty;
    $counties = County::all();
    $subCounties = SubCounty::all();
    @endphp
@csrf
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="idNo" class="form-label">Id Number</label>
                <input class="form-control" type="text" value="{{old('idNo')}}" name="idNo" placeholder="Enter your Id No">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="surName" class="form-label">SurName</label>
                <input class="form-control" type="text" value="{{old('surName')}}" name="surName" placeholder="Enter your surname">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input class="form-control" type="text" value="{{old('firstName')}}" name="firstName" placeholder="Enter your first name">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="secondName" class="form-label">Second Name</label>
                <input class="form-control" type="text" value="{{old('secondName')}}" name="secondName" placeholder="Enter your second name">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" value="{{old('gender')}}">
                    <option value="" selected disabled> Choose gender</option>
                <option value="Male" {{old('gender') == 'Male' ? 'selected' : ''}}>Male</option>
                <option value="Female " {{old('gender') == 'Female' ? 'selected' : ''}}>Female</option>
                <option value="Other" {{old('gender') == 'Other' ? 'selected' : ''}}>Other</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="dateOfBirth" class="form-label">Date Of Birth</label>
<<<<<<< HEAD
                <input class="form-control" type="date" id="dateofbirth" name="dateOfBirth">
=======
                <input class="form-control" type="date" value="{{old('dateOfBirth')}}" name="dateOfBirth">
>>>>>>> origin
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input class="form-control" type="text" value="{{old('age')}}" name="age" placeholder="Enter your age">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input class="form-control" type="text" value="{{old('phoneNumber')}}" name="phoneNumber" placeholder="Enter your phone number">
        </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="secondName" class="form-label">Next of Kin</label>
                <input class="form-control" type="text" name="nextOfKin" value="{{old('nextOfKin')}}" placeholder="Enter your next of kin name">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="country" class="form-check-label">Country</label>
                <select class="form-select" name="country" value="{{old('country')}}">
                    <option value="" selected disabled> Choose country</option>
                    <option value="Kenya" {{old('country') == 'Kenya' ? 'selected' : ''}}>Kenya</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="county" class="form-label">County</label>
                <select name="county" class="form-select" id="countyId">
                    <option value="" selected disabled>Choose County</option>
                    @foreach ($counties as $county )
                    <option value="{{$county->code}}" {{old('county') == $county->code ? 'selected' : ''}}>{{$county->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="subCounty" class="form-label">Sub County</label>
                <select name="subCounty" class="form-select" value="{{old('subCounty')}}" id="subCountyId">
                    <option value="" disabled selected>Choose subCounty</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input class="form-control" type="text" name="location" value="{{old('location')}}" placeholder="Enter your location">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="country" class="form-check-label">Occupation level</label>
                <select class="form-select" name="occupation">
                    <option value="" selected disabled> Choose occupation level</option>
                    <option value="Employed" {{old('occupation') == 'Employed' ? 'selected' : ''}}>Employed</option>
                    <option value="Unemployed" {{old('occupation') == 'Unemployed' ? 'selected' : ''}}>Unemployed</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="country" class="form-check-label">Marital Status</label>
                <select class="form-select" name="maritalStatus">
                    <option value="" selected disabled> Choose Marital Status</option>
                    <option value="Married" {{old('maritalStatus') == 'Married' ? 'selected' : ''}}>Married</option>
                    <option value="Divorced" {{old('maritalStatus') == 'Divorced' ? 'selected' : ''}}>Divorced</option>
                    <option value="Single" {{old('maritalStatus') == 'Single' ? 'selected' : ''}}>Single</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="country" class="form-check-label">Education level</label>
                <select class="form-select" name="education" value="{{old('education')}}">
                    <option value="" selected disabled> Choose education level</option>
                    <option value="Primary level" {{old('education') == 'Primary level' ? 'selected' : ''}}>Primary level</option>
                    <option value="Secondary level" {{old('education') == 'Secondary level' ? 'selected' : ''}}>Secondary level</option>
                    <option value="University or College level" {{old('education') == 'University or College level' ? 'selected' : ''}}>University or College level</option>
                </select>
            </div>
        </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  </div>
</form>
<script>
const County = document.getElementById('countyId');
County.addEventListener('change', function() {
    const countyId = County.value;
    const SubCounty = document.getElementById('subCountyId');

    SubCounty.innerHTML = '<option value="" disabled selected>Select Subcounty</option>';

    fetch(`/get/subcounties/${countyId}`)
        .then(response => response.json())
        .then(data => {
            data.subcounties.forEach(subcounty => {
                const option = document.createElement('option');
                option.value = subcounty.id;
                option.textContent = subcounty.name;
                SubCounty.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching subcounties:', error));
});

document.addEventListener("DOMContentLoaded", function () {
    const dobInput = document.getElementById("dateofbirth");
    const ageInput = document.querySelector("input[name='age']");

    // Set max attribute to today's date
    const today = new Date().toISOString().split("T")[0];
    dobInput.setAttribute("max", today);

    dobInput.addEventListener("change", function () {
        const dob = new Date(this.value);
        if (!isNaN(dob.getTime())) {
            const today = new Date();
            
            // Prevent future date selection
            if (dob > today) {
                alert("Date of birth cannot be in the future!");
                this.value = "";
                ageInput.value = "";
                return;
            }

            let years = today.getFullYear() - dob.getFullYear();
            let months = today.getMonth() - dob.getMonth();
            let days = today.getDate() - dob.getDate();

            if (days < 0) {
                months--;
                days += new Date(today.getFullYear(), today.getMonth(), 0).getDate(); // Adjust days
            }
            if (months < 0) {
                years--;
                months += 12;
            }

            // If less than a year, display months
            if (years === 0) {
                ageInput.value = `${months} month${months !== 1 ? "s" : ""}`;
            } else {
                ageInput.value = `${years} year${years !== 1 ? "s" : ""}`;
            }
        } else {
            ageInput.value = "";
        }
    });
});

</script>
@endsection
