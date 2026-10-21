## Look back 2 or 3

1. `dp[0] = true`.
2. `dp[i]` is true if `dp[i − 2]` and the last two are equal, or `dp[i − 3]` and the last three are equal or each one larger than the previous.
3. Return `dp[n]`.

Examples → true, false. Checked against trying every split recursively on 500 random arrays.

Greedy choices fail: in Example 1, taking [4,4,4] first leaves [5,6], which is not valid, while [4,4] then [4,5,6] works. Only three earlier values are needed, so O(1) space is possible.

Time: O(n)  
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
