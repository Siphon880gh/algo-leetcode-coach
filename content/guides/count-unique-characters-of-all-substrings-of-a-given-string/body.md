## Turn the sum around

Instead of looping over substrings, ask for each position `i` how many substrings count `s[i]` as unique.

Let `prev` be the index of the previous occurrence of `s[i]` (or −1), and `next` the next occurrence (or `n`). The substring must start in `(prev, i]` and end in `[i, next)`: `(i − prev) · (next − i)` choices.

Compute it with a list of positions per letter, or in one pass that, for each letter, keeps its last two positions and settles the middle one when a new occurrence arrives (flushing the rest at the end).

Do not enumerate substrings; there are O(n²) of them, each needing a count. Do not use the distance to the nearest occurrence of **any** letter; only the same letter matters.

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
