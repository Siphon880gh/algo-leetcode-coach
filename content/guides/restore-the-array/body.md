## Suffix DP

1. `dp[n] = 1`.
2. For `i` from `n − 1` down: if `s[i] == '0'`, `dp[i] = 0`; else sum `dp[j + 1]` while `int(s[i..j]) ≤ k` (at most `len(str(k))` digits).
3. Return `dp[0] mod (10⁹ + 7)`.

`"1000"`, k = 10000 → 1. `"1000"`, k = 10 → 0. `"1317"`, k = 2000 → 8.

Do not allow numbers starting with 0. Do not scan farther than the digit count of `k`; longer numbers always exceed it.

Time: O(n · log k)  
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
