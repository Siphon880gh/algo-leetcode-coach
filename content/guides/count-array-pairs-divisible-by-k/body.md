## Work on divisors of k

1. `cnt[g]` = how many `x` have `gcd(x, k) = g`.
2. For each pair of classes `g1 ≤ g2` with `g1 · g2 mod k = 0`: add `cnt[g1] · cnt[g2]`, or `cnt[g1] · (cnt[g1] − 1) / 2` when equal.

Examples → 7, 0. Checked against all pairs on 300 random arrays.

`x · y` is divisible by `k` exactly when `gcd(x, k) · gcd(y, k)` is. k ≤ 10^5 has at most 128 divisors, so the class pairs are few, while n² pairs would be 10^10.

Time: O(n log k + d²), d = divisors of k  
Space: O(d)

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
