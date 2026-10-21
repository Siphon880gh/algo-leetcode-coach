`StringIterator(compressedString)` takes a string like `"L1e2t1C1o1d1e1"`, where each letter is followed by how many times it repeats (the count can have several digits). `next()` returns the next uncompressed letter, or a space `' '` if there is none. `hasNext()` says whether letters remain. `"L1e2"` → `next()` gives `L`, `e`, `e`, then `' '`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Runs plus a pointer

In the constructor, scan the string: read a letter, then all the digits that follow, and append `(letter, count)` to `runs`. Set `i = 0` and `left = runs[0].count` (or 0 for an empty list).

- `hasNext()`: skip runs with `left == 0` by moving `i` forward and loading the next count; return `i < len(runs)`.
- `next()`: if `hasNext()` is false, return `' '`. Otherwise decrement `left` and return `runs[i].letter`.

Counts can be up to 10⁹, so never expand the runs into the full string.

Do not read only one digit per count; `a12` means twelve `a`s. Do not return an empty string when exhausted; the contract is a single space.

Time: O(length) to parse, O(1) amortized per call  
Space: O(number of runs)

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
