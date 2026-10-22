## Short palindromes suffice

1. `dp[0] = 0`.
2. For `i = 1 … n`: `dp[i] = dp[i − 1]`; for `L` in `k, k + 1`: if `s[i − L … i)` is a palindrome, `dp[i] = max(dp[i], dp[i − L] + 1)`.
3. Return `dp[n]`.

Examples → 2, 0. Checked against a DP over palindromes of every length on 400 random strings.

Trimming one letter from each end of a palindrome leaves a palindrome, so any longer pick can shrink to length k or k + 1. Each check costs O(k); a precomputed palindrome table makes it O(1).

Time: O(n · k)  
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
