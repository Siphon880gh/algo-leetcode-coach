## Tiny example

List every subset of `[1, 2]`. Start with an empty path:

```
path = []
```

1. **Take 1**, so `path = [1]`, and recurse.
   - Skip 2 and record `[1]`.
   - Take 2 and record `[1, 2]`.
2. **Undo**: pop 1, so `path = []` again.
3. **Skip 1** and recurse. This records `[]` and `[2]`.

Backtracking means you **choose, explore, then undo**. You can also prune: stop early when a partial path can no longer succeed, for example when its sum is already past the target.

## How

1. The state is the current `path` plus where you are in the input.
2. If the path breaks a rule, return right away. This is pruning.
3. If the path is complete, record it.
4. Otherwise try each next choice: add it, recurse, then undo it.

## Trap

Forgetting `path.pop()`, so the next branch still sees values left over from the previous one.

**Fix:** Every append needs a matching undo before you try the next choice. Passing a fresh copy into the recursion also works.

**Time:** often O(branches ^ depth)  
**Space:** O(depth) for the current path

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
