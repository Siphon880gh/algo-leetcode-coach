## Two tables

**Odd targets:** sort indices by `(value, index)`. Walk that order with a stack of indices; while the stack top is less than the current index, the current index is the top's odd target, so pop and record. Push the current index.

**Even targets:** same, but sort by `(−value, index)`.

**DP from the right:** `odd[n − 1] = even[n − 1] = true`. For `i` from `n − 2` down to 0:

- `odd[i] = even[oddNext[i]]` if that target exists, else false.
- `even[i] = odd[evenNext[i]]` if that target exists, else false.

Return the number of `i` with `odd[i]` (every start begins with an odd jump).

Walking in sorted order, the first later index that appears after an index holds its smallest qualifying value, with ties going to the smaller index.

Do not search for each target by scanning to the right; that is O(n²). A balanced tree (TreeMap) from the right also works in O(n log n).

Time: O(n log n)  
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
