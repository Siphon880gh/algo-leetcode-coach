## Two states per digit

The term `x^i` costs `i` operators (`x * x * …`) plus one sign, except `x^0 = x / x`, which costs 2.

Going from the lowest digit up, keep:

- `pos` = the cost to build the low part exactly.
- `neg` = the cost to build (`x^k` − low part), so the next digit absorbs a carry of 1.

```
pos = neg = k = 0
while target:
    target, d = divmod(target, x)
    if k == 0:
        pos, neg = 2 * d, 2 * (x - d)
    else:
        pos, neg = (min(d * k + pos, (d + 1) * k + neg),
                    min((x - d) * k + pos, (x - d - 1) * k + neg))
    k += 1
return min(pos, k + neg) - 1
```

The final `k + neg` uses one more `x^k` to cover the carry; `− 1` removes the sign in front of the first term.

Do not try every expression; the search space is huge. Do not forget that the ones digit costs 2 per term (`x / x`).

Time: O(log_x target)  
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
