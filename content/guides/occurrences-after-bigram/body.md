## Sliding triple

`w = text.split()`. For `i` from 2 to `len(w) − 1`: if `w[i − 2] == first` and `w[i − 1] == second`, append `w[i]`.

Return the list.

Overlapping matches count: in `"we will we will rock you"` with `first = "we"`, `second = "will"`, both `"we"` and `"rock"` are collected.

Do not search the raw text for `first + " " + second` with substring matching; it can match inside longer words. Do not skip ahead after a match; overlaps must be kept.

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
