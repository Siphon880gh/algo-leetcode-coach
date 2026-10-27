## Masks of distinct primes

1. `cnt[x]` for `x` in 1..30. Primes: 2, 3, 5, 7, 11, 13, 17, 19, 23, 29.
2. For each `x` in 2..30 with `cnt[x] > 0` and no squared prime factor (skip 4, 8, 9, 12, …), compute `mask`.
3. `f[0] = 1`; for each such `x`, for `s` from 1023 down: if `s` contains `mask`, `f[s] += f[s ^ mask] · cnt[x]`.
4. Answer = `(Σ_{s ≥ 1} f[s]) · 2^cnt[1]` mod 1e9+7.

Examples → 6, 5. Checked against enumerating subsets on random arrays.

Different values are different choices, so each value is used at most once per subset, and `cnt[x]` picks which copy. The 1s never change the product but give distinct subsets, hence the power of two. The empty-mask state `f[0]` is excluded because the product must contain a prime.

Time: O(30 · 2^10 + n)  
Space: O(2^10)

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
