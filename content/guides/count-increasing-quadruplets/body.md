## One counter per j

1. `cnt[j] = 0` for all `j`; `ans = 0`.
2. For each `l` (it plays both k and l): `small = 0`; for `j < l`: if `nums[j] < nums[l]`, `small++` and `ans += cnt[j]`; else `cnt[j] += small`.
3. Return `ans`.

Examples → 2, 0. Checked against all quadruplets on 300 random permutations.

When `nums[j] > nums[l]`, the current index acts as k, and `small` counts the i before j that are smaller than it. When `nums[j] < nums[l]` it acts as l and closes every triple counted for j. The answer can reach about 10^13, so use 64-bit.

Time: O(n²)  
Space: O(n)

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
