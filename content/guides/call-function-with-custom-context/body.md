## Temporary method

1. `s = Symbol()`; define `ctx[s] = this` as a non-enumerable property.
2. `r = ctx[s](...args)`; `delete ctx[s]`; return r.

Examples → 12, The cost of the burger is 11. Checked in Node; the context object has no extra keys afterwards.

A string key such as fn could clash with a real property and, if not removed, stays visible on the object. `this.bind(ctx)(...args)` and `this.apply(ctx, args)` also avoid Function.call.

Time: O(1) besides fn  
Space: O(1)

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
