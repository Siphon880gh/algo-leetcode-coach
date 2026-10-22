Given a function fn, return its curried version: a function that can be called with the arguments in any grouping, across several calls, and that calls fn once it has received as many arguments as fn expects (fn.length). The exact rules and examples are in the official statement. For instance, with sum3 = (a, b, c) => a + b + c, curry(sum3)(1)(2)(3), curry(sum3)(1, 2)(3) and curry(sum3)(1)(2, 3) all give 6. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Gather and check

1. `curry(fn)` returns `function c(...args)`.
2. If `args.length ≥ fn.length`, return `fn(...args)`.
3. Otherwise return `(...more) => c(...args, ...more)`.

Constructed checks (run in Node): the three groupings above → 6, all three arguments at once → 6, and a function with no parameters runs on the first call.

Each partial call builds a fresh array, so two branches from the same partial call do not share arguments.

Time: O(total arguments) per completed call  
Space: O(fn.length)

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
