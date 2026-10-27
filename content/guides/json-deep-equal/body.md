You get two values that came from JSON.parse (numbers, strings, booleans, null, arrays and plain objects, nested to any depth). Decide whether they are deeply equal: the same primitive value, or arrays with equal elements in the same order, or objects with the same keys whose values are deeply equal. The exact rules and limits are in the official statement. For instance, {x: 1, y: [1,2]} and {y: [1,2], x: 1} → true; [1,2] and [2,1] → false; {a: 1} and {a: 1, b: null} → false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Recursive comparison

1. If `a === b`, return true.
2. If either is not an object, or is null, return false.
3. If one is an array and the other is not, return false.
4. Compare key counts; then every key of `a` must be an own key of `b` with `deq(a[key], b[key])`.

Constructed checks (run in Node): the cases above → true, false, false; nested objects inside arrays compare equal; 1 and the string 1 are not equal.

Key order does not matter for objects, but array order does, which comparing by index gives automatically. A null value still counts as a key, so {a: 1} and {a: 1, b: null} differ.

Time: O(total size)  
Space: O(depth)

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
