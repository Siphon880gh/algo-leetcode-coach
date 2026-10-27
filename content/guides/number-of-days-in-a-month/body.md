Given a year and a month (1 to 12), return how many days that month has in that year. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Fixed table plus February

`days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]`.

If `month == 2` and the year is a leap year, return 29; otherwise return `days[month − 1]`.

Leap year: `(year % 4 == 0 and year % 100 != 0) or year % 400 == 0`. So 2000 is a leap year, 1900 is not, and 2024 is.

Do not treat every year divisible by 4 as a leap year; century years need the 400 rule. Do not use a date library's month arithmetic unless it is known to follow the Gregorian rule for the years given.

Time: O(1)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
