Two arrays hold only 0s and 1s. Replace every 0 with an even positive integer and every 1 with an odd one so that both arrays are increasing and no integer is used twice. Return the smallest possible largest integer. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Shared counter

1. nxt(x, b) = the smallest number above x with parity b.
2. f[0][0] = 0; f[i][j] = min(nxt(f[i − 1][j], a[i − 1]), nxt(f[i][j − 1], b[j − 1])).
3. Return f[n][m].

Constructed checks (run in code): [] and [1, 0, 1, 1] → 5; [0, 1, 0, 1] and [1, 0, 0, 1] → 9; [1] and [1] → 3. Checked against a search over all assignments on 60 random small cases.

Filling each array on its own reuses numbers: [1] and [1] → 1 instead of 3.

Time: O(n m)  
Space: O(n m)

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
