## O(n²) table

1. `isPal[i][j] = s[i] == s[j] and (j − i < 2 or isPal[i + 1][j − 1])`, filled with i descending.
2. For cut ends `i` (first piece `0 … i`) and `j` (middle `i + 1 … j`), `0 ≤ i < j < n − 1`:
   return true if all three pieces are palindromes.

`"abcbdd"` → `"a" | "bcb" | "dd"` → true. `"bcbddxy"` → false.

Fill the table bottom-up; reading `isPal[i + 1][j − 1]` before it exists gives wrong answers.

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
