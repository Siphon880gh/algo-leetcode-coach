## Two runs

1. `m = min(n, target // 2)`, `r = n − m`.
2. Sum = `m(m + 1) / 2 + r · target + r(r − 1) / 2`, mod 10^9 + 7.

Examples → 4, 8, 1. Checked against the greedy pick for every n, target < 30.

From each pair (i, target − i) take the smaller; after target // 2 the next safe number is target. n reaches 10^9, so a loop is too slow; the formula needs 64-bit before the mod.

Time: O(1)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
