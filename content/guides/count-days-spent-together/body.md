## Dates to numbers

1. `day(MM-DD)` = sum of the lengths of months before MM, plus DD, using 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31.
2. Return `max(0, min(day(leaveAlice), day(leaveBob)) − max(day(arriveAlice), day(arriveBob)) + 1)`.

Examples → 3, 0.

Both ends are inclusive, hence the + 1. The year is not a leap year, so February has 28 days. Comparing the strings directly works for max and min, since MM-DD sorts like the dates, but the count still needs day numbers.

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
