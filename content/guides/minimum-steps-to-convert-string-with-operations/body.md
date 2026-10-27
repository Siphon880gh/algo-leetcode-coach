## Piece cost

1. c(a, b): scan positions with a[i] ≠ b[i]; if a waiting (b[i], a[i]) mismatch exists, pair them (already counted), else count 1 and wait.
2. cost(piece) = min(c(piece, target), 1 + c(reverse(piece), target)).
3. dp[j] = min over i < j of dp[i] + cost(word1[i:j]); answer dp[n].

Examples → 4, 4, 2. Checked against trying every reverse, swap set and replacement on 200 random pairs.

Never reversing: example 3 → 5 instead of 2.

Time: O(n³)  
Space: O(n)

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
