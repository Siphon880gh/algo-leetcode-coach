## Tiny example

List all subsets of `[1, 2]`.

```
path = []
```

1. For element 1, **take** it, so `path = [1]`. Recurse on element 2, which records `[1]` and `[1,2]`.
2. **Undo**, so `path = []` again.
3. For element 1, **skip** it. Recurse on element 2, which records `[]` and `[2]`.

The result is `[], [2], [1], [1,2]`.

That loop of choosing, exploring and undoing **is** backtracking. It is not a new language keyword. It is recursion that restores shared state.

## How

1. Keep a mutable `path`, or something similar.
2. Recurse after each choice.
3. Restore the state (`pop`) before trying the next choice.
4. Alternatively, pass an immutable copy. This is clearer but often slower.

## Trap

Thinking you need a special "backtrack" feature in the language.

**Fix:** If you can recurse and undo, you can backtrack.

**Space:** O(depth) for the current path

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
