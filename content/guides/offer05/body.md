## Tiny example (Sword Finger Offer 05)

Replace every space with `%20`.

```
s = "We are"
```

There is 1 space. Each space becomes 3 characters (`%20`), so the length grows by 2 for each space.

The new length is `6 + 2×1 = 8`.

Fill the buffer **from the end**, so the longer writes do not overwrite characters you still need to read:

1. Read `'e'` and write it at the end.
2. Read `'r'` and write it.
3. Read `'a'` and write it.
4. Read `' '` and write `%20`, which is three characters.
5. Continue with `'e'`, then `'W'`.

The result is `We%20are`.

## Why from the end?

If you write `%20` from left to right in a shared buffer, you push unread letters to the right and can easily overwrite them. Writing into the reserved space at the end leaves the unread part untouched.

## Steps

1. Count the spaces.
2. Allocate, or set the length to, `n + 2 × spaces`.
3. Keep two indices: one reads from the old end, and one writes from the new end.
4. On a space, write `%20` and move the write index by 3. Otherwise, copy one character.

## Trap

Inserting `%20` into the middle of the string again and again. Each insert shifts everything after it.

**Fix:** Count once, size the buffer once, and write once from the end. This takes **O(n)** time and **O(n)** space for the new buffer, or works in place if the buffer already has room.

**Time:** O(n)  
**Space:** O(n), or O(1) extra if the buffer is already sized

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
