## A part must hold every copy of its letters

1. `last[c]` = the last index of each letter.
2. `start = 0`, `end = 0`. For each `i`: `end = max(end, last[s[i]])`. If `i == end`, record the size `end − start + 1` and set `start = i + 1`.

Cutting as soon as `i == end` gives the most parts: every letter in `[start, end]` has all its copies inside, and no earlier cut was possible.

Do not cut when a letter is first seen; its later copies must stay in the same part. Do not return the parts' contents; the problem asks for their sizes.

Time: O(n)  
Space: O(1) (26 letters)

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
