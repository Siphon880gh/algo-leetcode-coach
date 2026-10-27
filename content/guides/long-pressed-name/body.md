## Every extra key must be a repeat

`i = 0` (name), for `j` over `typed`:

- If `i < len(name)` and `name[i] == typed[j]`: `i += 1`.
- Else if `j > 0` and `typed[j] == typed[j − 1]`: it is a long press; continue.
- Else return false.

Return `i == len(name)`.

Matching first and treating repeats second handles names with double letters, like `"aab"`, where the second `a` must be matched, not absorbed.

Do not compare run-length groups only by letter; each typed run must be at least as long as the name's run. (The two-pointer loop enforces this automatically.) Do not return true without checking that the whole name was consumed.

Time: O(len(name) + len(typed))  
Space: O(1)

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
