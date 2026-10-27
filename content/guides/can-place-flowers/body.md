## Plant as early as possible

For each `i`: if `bed[i] == 0`, the left neighbor is 0 or missing, and the right neighbor is 0 or missing, plant there (`bed[i] = 1`) and count it. Return true once the count reaches `n`.

Planting as early as possible is safe: it only blocks plot `i + 1`, and any plan that plants later can be shifted left to `i` without losing a flower.

Padding the array with a 0 on each end removes the edge checks.

Do not count empty plots and divide by 2; runs at the edges and runs in the middle hold different numbers (`[0,0,1]` fits one, `[1,0,0,0,1]` fits one). Do not forget to mark the plot you plant, or the next plot will also look free.

Time: O(n)  
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
