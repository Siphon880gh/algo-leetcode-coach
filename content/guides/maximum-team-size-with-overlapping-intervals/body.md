You get the start and end times of n employees’ work intervals. A team is valid when some member’s interval overlaps the interval of every other member. Return the largest possible team size. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Per person

1. ends = sorted end times; starts = sorted start times.
2. For [l, r]: overlapping = n − (ends < l) − (starts > r).
3. Return the largest count.

Assumed here: intervals are closed, so touching at an endpoint counts as overlapping, and a team is valid when one member’s interval overlaps every other member’s.

Constructed checks (made-up values, run in code): starts [1, 2, 6, 3], ends [4, 3, 8, 5] → 3; starts [1, 5], ends [5, 9] → 2. Checked against every team on 1,500 random cases.

Not counting touching endpoints: the second check → 1 instead of 2.

Time: O(n log n)  
Space: O(n)

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
