## Build, then verify

1. For `i = 0 … n − 1`: if `word[i]` is unset, give it the next letter (more than 26 → return empty), and set every unset `j > i` with `lcp[i][j] > 0` to the same letter.
2. Rebuild: `L[i][j] = L[i + 1][j + 1] + 1` if `word[i] = word[j]`, else 0, from the bottom right.
3. Return `word` if `L = lcp`, else the empty string.

Examples → abab, aaaa, empty. Checked against all strings over four letters up to length 5, plus 300 random matrices.

Giving each new class the smallest unused letter is the lexicographically smallest choice, and the full check catches every inconsistent matrix, including a wrong diagonal.

Time: O(n²)  
Space: O(n²)

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
