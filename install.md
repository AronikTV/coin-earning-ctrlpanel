# Installation Guide

Before deploying the CtrlPanel.GG Coin Earning System to your production server, it’s wise to download all the necessary files from this repository to your local computer. This will allow you to configure and customize the system as needed before going live. Follow these steps to get started:

## Step 1: Clone the Repository

1. Open your terminal or command prompt.

2. Navigate to the directory where you want to store the system files on your local computer using the `cd` command.

3. Clone the repository by running the following command:

   ```shell
   git clone https://github.com/aroniktv/ctrlpanel-gg-coin-earning-system.git

   ```

## Step 2: Configure the Variables (Linkvertise)

1. Open up the EarnController.php which can be found in /app/Http/Controllers.

2. Replace `https://my.domain.example` by the Domain of your CtrlPanel. !!!Do NOT ADD A / !!!

3. Replace `yourid` with your Linkvertise Publisher ID which you can find in the Full Script API Section.

4. Change the Variable `$reward` to the Amount of Coins you want to give a user for an ads session. The default is 30. `($reward = 30;)`

5. Save the File.

## Step 3: Configure the Variables (Google Adsense)

1. Open up the EarnController.php which can be found in /app/Http/Controllers.

2. Change the Variable `$reward_a` to the Amount of Coins you want to give a user for an ads session. The default is 5. `($reward_a = 5;)`

3. Save the File.

4. Open up the adpage.blade.php which can be found in in /resources/views/earn/.

5. Replace every placeholder “xxxxxxx” with the variables you get from Adsense

6. Save the File.

## Step 4: Configure the Domains

1. Open up the earn.blade.php which can be found in /resources/views/.

2. Change the Domain `https://my.domain.example` to your CtrlPanel Domain. !!!Do NOT ADD A / !!!

3. Save the File.

## Step 5: Add the Routings and the Navigation and do the last steps.

1. Open up the web.php file which can be found in /routes/. (This is in your CtrlPanel Installation)

2. Add this to the Top of the Web.php:

   ```shell
   use App\Http\Controllers\EarnController;

   ```

3. Add this to the Bottom of the File under the Home Route:

   ```shell
   Route::get('/earn', [EarnController::class, 'index'])->name('earn.index');
   Route::get('/earn/lv', [EarnController::class, 'start'])->name('earn.start');
   Route::get('/earn/ad', [EarnController::class, 'adsense'])->name('earn.adsense');
   Route::view('/adblocker-found', 'adblocker_found')->name('adblocker_found');

   Route::get('/earn/adpage', [EarnController::class, 'timerPage'])->name('earn.adpage');
   Route::get('/earn/return', [EarnController::class, 'redirectToEarnIndex'])->name('earn.return');
   Route::get('/redeem', [EarnController::class, 'redeem'])->name('earn.redeem');

   ```

4. Save the File.

5. Upload the other files to the Live CtrlPanel Folder
