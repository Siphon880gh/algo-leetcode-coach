## Tiny example (剑指 Offer 58-II)

Left-rotate string `s` by `n` characters.

```
s = "abcdefg"
n = 2
```

The first `2` chars `ab` move to the end → `"cdefgab"`.

## How (three reversals, in-place friendly)

Think of `s` as `A + B` with `|A| = n`.

1. Reverse all of `s` → `B_rev + A_rev`
2. Reverse the new prefix of length `|B|` → `B + A_rev`
3. Reverse the suffix of length `|A|` → `B + A`

For the example:

1. Reverse all: `gfedcba`
2. Reverse first `5` (`7-2`): `cdefgba`
3. Reverse last `2`: `cdefgab`

(Equivalently: slice `s[n:] + s[:n]` if creating a new string is allowed.)

## Trap

Rotating one character at a time with deletes/inserts at the front — O(n) per step → O(n²).

**Fix:** One slice concat, or the three-reversal trick — **O(n)** time.

**Time:** O(n)  
**Space:** O(1) extra with reversals in-place; O(n) if you build a new string

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
