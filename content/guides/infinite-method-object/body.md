Return an object on which calling any method, whatever its name, returns that method’s name as a string. The exact rules are in the official statement. For instance, obj.abc123() → abc123. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Proxy

1. Return `new Proxy({}, { get: (_, prop) => () => prop.toString() })`.

Constructed checks (run in Node): obj.abc123() → abc123, a bracketed name with a space → that name, obj.x() → x.

The get trap runs for every property read, including names that look like methods, so no names need to be known in advance.

Time: O(1) per call  
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
