## Tiny example

List all subsets of `[1, 2]`.

```
path = []
```

1. Decide about 1: **take** → `path = [1]` → recurse on 2 → record `[1]` and `[1,2]`
2. **Undo** → `path = []`
3. Decide about 1: **skip** → recurse on 2 → record `[]` and `[2]`

Result: `[], [2], [1], [1,2]`.

That choose → explore → undo loop **is** backtracking. It is not a new keyword — it is recursion that restores shared state.

## How

1. Keep a mutable `path` (or equivalent)
2. Recurse after each choice
3. Restore (`pop`) before the sibling choice
4. Or pass an immutable copy (clearer, often slower)

## Trap

Thinking you need a special “backtrack” feature in the language.

**Fix:** If you can recurse and undo, you can backtrack.

**Space:** O(depth) for the live path

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
