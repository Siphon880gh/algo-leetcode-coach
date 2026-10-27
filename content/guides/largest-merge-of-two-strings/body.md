## Suffix comparison

1. `i`, `j` index `word1`, `word2`.
2. If `word1[i:] > word2[j:]`, take `word1[i]`; otherwise take `word2[j]`.
3. Append whatever is left when one runs out.

`"cabaa", "bcaaa"` → `"cbcabaaaaa"`. `"abcabc", "abdcaba"` → `"abdcabcabcaba"`.

Comparing only the next character fails on ties: when the heads are equal, the rest of each suffix decides which string to draw from.

Time: O((m + n)²) worst case  
Space: O(m + n)

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
