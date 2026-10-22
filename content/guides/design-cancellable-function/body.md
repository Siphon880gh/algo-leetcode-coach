## Drive the generator

1. Make `cancelP`, a promise whose reject is called with the string Cancelled by `cancel()`; attach an empty catch so it is never unhandled.
2. `promise` is an async loop: `step = gen.next()`; while not `step.done`: try `step = gen.next(await Promise.race([step.value, cancelP]))`, catch `e` → `step = gen.throw(e)`.
3. Return `step.value`. Return `[cancel, promise]`.

Examples → resolved 42, rejected Error: Hello, rejected Cancelled, resolved 2, resolved 1, resolved 4. Checked in Node with real timers.

If the generator does not catch a thrown error, gen.throw rethrows it, which rejects the async loop, which is exactly the required behaviour. Once cancelled, every later race loses to cancelP at once.

Time: O(1) per yield besides the awaited work  
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
