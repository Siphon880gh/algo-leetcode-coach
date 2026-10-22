Given a function fn and a time t in milliseconds, return a throttled version. The first call runs fn at once and starts a window of t ms. Calls during the window do not run fn; only the latest arguments are kept. When the window ends, if arguments were kept, fn runs with them and a new window starts; otherwise the next call runs at once again. The exact rules and examples are in the official statement. For instance, with t = 50 and calls at 0, 10 and 20 ms with inputs 1, 2 and 3, fn runs at 0 with 1 and at 50 with 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Window timer

1. State: `id = null` (no window), `pending = null`.
2. Call: if `id = null`, run `fn(...args)` and `id = setTimeout(tick, t)`; else `pending = args`.
3. `tick`: if pending, run fn with it, clear it, and restart the timer; else `id = null`.

Constructed checks (run in Node with real timers): t = 50 with calls at 0, 10, 20 → runs at 0 with 1 and at 50 with 3; a further call at 130, after the window has closed, runs at once.

Restarting the window after a pending run matters: without it, a call right after that run would also execute immediately, closer than t ms.

Time: O(1) per call  
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
