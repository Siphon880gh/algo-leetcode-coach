## Submask enumeration

1. `cnt` = counts of distinct values; `need[s]` = Σ quantity over customers in `s`.
2. `f(i, mask)`: true if `mask == 0`; false if `i == len(cnt)`.
3. Try each submask `sub` of `mask` with `need[sub] ≤ cnt[i]` (including empty): `f(i + 1, mask ^ sub)`.

`[1,2,3,4]`, `[2]` → false. `[1,2,3,3]`, `[2]` → true. `[1,1,2,2]`, `[2,2]` → true.

Submask enumeration over all masks costs O(3^m) per value. Do not split one customer across values; each gets a single integer.

Time: O(k · 3^m) with k ≤ 50  
Space: O(k · 2^m)

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
