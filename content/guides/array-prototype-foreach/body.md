Add a forEach method to every array without using the built-in one. It takes a callback and a context object, and calls the callback for each element with the element, its index and the array, with this set to the context. The exact argument order and limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Loop with call

1. For i = 0 … length − 1: `callback.call(context, this[i], i, this)`.

Constructed check (run in Node): [1, 2, 3] with a callback setting `a[i] = v * this.m` and context {m: 2} → [2, 4, 6].

Calling `callback(this[i], i, this)` directly drops the context: in Node the same check gives NaN values. An arrow callback ignores the context anyway, which is the caller’s choice.

Time: O(n)  
Space: O(1)

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
