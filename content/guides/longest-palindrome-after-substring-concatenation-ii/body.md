## Mirror plus middle

1. Expand around every center to fill ps (longest palindrome starting at each index of s) and pe (ending at each index of t).
2. f[i][j] = f[i − 1][j + 1] + 1 if s[i] = t[j]; candidate 2 · f + max(ps[i + 1], pe[j]).
3. Also take the longest palindrome inside s or t alone.

Examples → 2, 1, 4, 5. Checked against trying every pair of substrings on 200 random cases.

Leaving out the middle palindrome: example 4 → 4 instead of 5.

Time: O(n · m + n² + m²)  
Space: O(n · m), or O(m) with rolling rows

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
