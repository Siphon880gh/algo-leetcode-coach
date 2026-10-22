Build a batcher around an async function that takes an array of keys and resolves with an array of values in the same order. Callers ask for one key at a time and get a promise for its value; the batcher groups requests that arrive close together into a single call, throttled by a time window. The class and method names, the exact throttle rule, and how errors are reported are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Queue and flush

1. A request pushes `{key, resolve, reject}` and makes sure a flush is scheduled under the throttle rule.
2. Flush: `batch = queue`; `queue = []` straight away; call the function with the batch’s keys.
3. On success resolve `batch[i]` with `values[i]`; on failure reject each caller in the batch.

Constructed check (run in Node, with a function that appends !): requests for a, b, c and then d → a!, b!, c!, d! in two calls.

Swap in a fresh queue before awaiting: clearing it only after the call returns sends late arrivals nowhere, and in Node a request made during the call → undefined instead of b!.

Time: O(1) per request besides the calls  
Space: O(pending requests)

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
