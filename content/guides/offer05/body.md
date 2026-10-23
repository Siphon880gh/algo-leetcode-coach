## Tiny example (剑指 Offer 05)

Replace every space with `%20`.

```
s = "We are"
```

Spaces: 1. Each space becomes 3 characters (`%20`), so length grows by 2 per space.

New length = `6 + 2×1 = 8`.

Fill a buffer **from the end** so expanding writes do not overwrite characters you still need to read:

1. Read `'e'` → write at the end
2. Read `'r'` → write
3. Read `'a'` → write
4. Read `' '` → write `%20` (three chars)
5. Continue with `'e'`, `'W'`

Result: `We%20are`

## Why from the end?

If you write `%20` left-to-right in a shared buffer, you shove unread letters right and easily clobber them. Writing into already-reserved tail space keeps unread prefix intact.

## Steps

1. Count spaces
2. Allocate / set length to `n + 2 × spaces`
3. Two indices: read from old end, write toward new end
4. On space, write `%20` and move write index by 3; else copy one char

## Trap

Inserting `%20` in the middle of a live string repeatedly (each insert shifts the tail).

**Fix:** Count once, size once, write once from the end — **O(n)** time, **O(n)** space for the new buffer (or in-place if the buffer already has spare room).

**Time:** O(n)  
**Space:** O(n) (or O(1) extra if the buffer is pre-sized)

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
