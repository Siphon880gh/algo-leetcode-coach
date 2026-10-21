## Distinct-subsequence DP

1. `e1 = e0 = 0`, `hasZero = false`.
2. On `1`: `e1 = e1 + e0 + 1`. On `0`: `e0 = e1 + e0`; `hasZero = true`.
3. Return `e1 + e0 + hasZero` mod 1e9+7.

`"001"` → 2. `"11"` → 2. `"101"` → 5. Checked against enumerating distinct subsequences on random strings.

Setting (not adding to) `e1` on a `1` is what removes duplicates: every distinct subsequence ending in 1 is some earlier one plus this 1. Leading zeros are excluded by never starting with 0; `"0"` alone is added at the end.

Time: O(n)  
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
