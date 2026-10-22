A class is built from a JSON object and has a method, produce, that takes a mutator function. produce passes the mutator a proxy of the object; the mutator may appear to change it, including nested values, and produce returns a new object with those changes applied while the original stays untouched. Which operations the mutator may use, and any efficiency requirements, are in the official statement. For instance, starting from an object with x = 5, a mutator that sets x to x + 1 produces an object with x = 6 and leaves the original at 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Record, then rebuild

1. `changes` = map from a path to its new value.
2. Proxy at path p: `get(k)` returns the recorded value for p + k if any, else wraps objects as proxies at p + k, else the raw value; `set(k, v)` records p + k → v.
3. After the mutator runs, rebuild from the root: an object with no change at or below it is reused as is; otherwise copy it, write its direct changes and rebuild changed children.

Constructed checks (run in Node): x 5 → 6 with the original unchanged; setting a.b in {a: {b: 1}, c: {d: 2}} gives a new a while c is the same object as before; setting arr[0] copies just that array.

Sharing untouched subtrees keeps produce proportional to the changes rather than the object size, which matters when produce is called often on large objects.

Time: O(reads + changes · depth)  
Space: O(changes · depth)

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
