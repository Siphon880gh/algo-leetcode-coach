## Tiny example (Sword Finger Offer 58-II)

Rotate the string `s` left by `n` characters.

```
s = "abcdefg"
n = 2
```

The first `2` characters, `ab`, move to the end, giving `"cdefgab"`.

## How (three reversals, which works in place)

Think of `s` as `A + B`, where `A` is the first n characters.

1. Reverse all of `s`. This gives reversed B followed by reversed A.
2. Reverse the first `|B|` characters. This gives `B` followed by reversed A.
3. Reverse the last `|A|` characters. This gives `B + A`.

For the example:

1. Reverse everything: `gfedcba`.
2. Reverse the first `5` characters (`7-2`): `cdefgba`.
3. Reverse the last `2`: `cdefgab`.

If you are allowed to create a new string, the slice `s[n:] + s[:n]` does the same thing.

## Trap

Rotating one character at a time by deleting from the front and appending. Each step costs O(n), so the total is O(n²).

**Fix:** Use one slice and concatenation, or the three-reversal trick, for **O(n)** time.

**Time:** O(n)  
**Space:** O(1) extra with in-place reversals; O(n) if you build a new string

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
