## Tiny example

Subsets of `[1, 2]`:

```
path = []
```

1. **Take 1** → `path = [1]` → recurse
   - skip 2 → record `[1]`
   - take 2 → record `[1,2]`
2. **Pop 1** → `path = []`
3. **Skip 1** → recurse → record `[]` and `[2]`

Backtracking = **choose → explore → undo**. Prune when a partial path cannot succeed (for example sum already past a target).

## How

1. State = current `path` + index / choice point
2. If illegal → return (prune)
3. If complete → record answer
4. Else try each next choice, recurse, then undo

## Trap

Forgetting `path.pop()` so sibling branches see leftover values.

**Fix:** Every append has a matching undo before the next sibling — or pass a fresh copy.

**Time:** often O(branch^depth)  
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
