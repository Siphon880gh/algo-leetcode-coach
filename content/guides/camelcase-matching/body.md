## Insert only lowercase letters

For each query, `j = 0`. For each character `c` in the query:

- If `j < len(pattern)` and `c == pattern[j]`, `j += 1`.
- Else if `c` is uppercase, the query fails.

The query matches when it did not fail and `j == len(pattern)`.

Do not compare only the uppercase letters; the pattern's lowercase letters must appear in order too. Do not forget the end check; an unfinished pattern is a mismatch.

Time: O(total query length)  
Space: O(1) beyond the output

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
