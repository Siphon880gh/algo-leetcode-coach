## Tokens

- **Element:** one uppercase letter, then any lowercase letters, then optional digits (default 1). Add to the top counter.
- **`(`:** push an empty counter.
- **`)`:** read the optional digits that follow (default 1). Pop the top counter, multiply every count, and merge into the new top.

At the end, sort the element names and write each name followed by its count when the count is above 1.

Recursion works the same way: `parse()` returns a counter when it meets `)` or the end, and the caller multiplies it.

Do not read a single digit; counts like `12` have several. Do not treat the lowercase letters as separate elements; `Mg` is one atom. Do not write `1` after an element with count 1.

Time: O(n²) worst case from merging nested counters (with sorting, O(n log n) for output)  
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
