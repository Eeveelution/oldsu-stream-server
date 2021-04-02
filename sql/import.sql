CREATE TABLE stream_stats (
    UserID bigint NOT NULL,
    Username varchar(25) NOT NULL,
    RankedScore bigint NOT NULL,
    Accuracy double NOT NULL,
    Playcount int(11) NOT NULL,
    CountSSH int(11) NOT NULL,
    CountSS int(11) NOT NULL,
    CountSH int(11) NOT NULL,
    CountS int(11) NOT NULL,
    CountA int(11) NOT NULL,
    CountB int(11) NOT NULL,
    CountC int(11) NOT NULL,
    CountD int(11) NOT NULL,
    Acc300 int(11) NOT NULL,
    Acc100 int(11) NOT NULL,
    Acc50 int(11) NOT NULL,
    AccMiss int(11) NOT NULL,
    PRIMARY KEY (UserID)
);

CREATE TABLE stream_scores (
    ScoreID bigint NOT NULL AUTO_INCREMENT,
    Filename text NOT NULL,
    Difficulty tinyint NOT NULL,
    Username varchar(25) NOT NULL,
    HitScore int(11) NOT NULL,
    AccuracyScore int(11) NOT NULL,
    ComboScore int(11) NOT NULL,
    SpinnerScore int(11) NOT NULL,
    Count300 int(11) NOT NULL,
    Count100 int(11) NOT NULL,
    Count50 int(11) NOT NULL,
    CountMiss int(11) NOT NULL,
    MaxCombo int(11) NOT NULL,
    ScoreDate bigint NOT NULL,
    PRIMARY KEY (ScoreID)
);

CREATE TABLE stream_beatmaps (
    LocalID bigint NOT NULL AUTO_INCREMENT,
    Filename text NOT NULL,
    Revision varchar(16) NOT NULL,
    RankedStatus varchar(20) NOT NULL,
    Difficulty tinyint NOT NULL,
    LocalBeatmapsetID int(11) NOT NULL,
    Metadata text NOT NULL,
    PRIMARY KEY (LocalID)
);

CREATE TABLE stream_packs (
    LocalID bigint NOT NULL AUTO_INCREMENT,
    PackID text NOT NULL,
    PackName text NOT NULL,
    Beatmaps text NOT NULL,
    PRIMARY KEY (LocalID)
);